<?php

declare(strict_types=1);

namespace App\XM\Presentation\Http\Controller;

use App\XM\Domain\CompanyService;
use App\XM\Domain\Dto\HistoricalDataRequestDto;
use App\XM\Domain\Dto\InfoEmailDto;
use App\XM\Domain\Entity\Company;
use App\XM\Domain\HistoricalDataService;
use App\XM\Domain\Interfaces\HistoricalDataFormatterInterface;
use App\XM\Infrastructure\Event\SendInfoEmailEvent;
use App\XM\Infrastructure\Helpers\ArrayHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DefaultController extends AbstractController
{
    private ValidatorInterface $validator;
    private CompanyService $companyService;
    private EventDispatcherInterface $eventDispatcher;
    private HistoricalDataService $historicalDataService;
    private HistoricalDataFormatterInterface $historicalDataFormatter;

    public function __construct(
        ValidatorInterface $validator,
        EventDispatcherInterface $eventDispatcher,
        CompanyService $companyService,
        HistoricalDataService $historicalDataService,
        HistoricalDataFormatterInterface $historicalDataFormatter
    )
    {
        $this->validator = $validator;
        $this->companyService = $companyService;
        $this->eventDispatcher = $eventDispatcher;
        $this->historicalDataService = $historicalDataService;
        $this->historicalDataFormatter = $historicalDataFormatter;
    }

    /**
     * @Route("/historical", methods={"GET","POST"}, name="historicalIndexPage")
     */
    public function index(Request $request): Response
    {
        $chartData = [];
        $data = [];
        $symbols = $this->companyService->getSymbols();

        if (!ArrayHelper::isArrayEmpty($request->request->all())) {
            $companySymbol = $request->request->get('companySymbol');
            $email = $request->request->get('email');

            $strStartDate = $request->request->get('startDate');
            $strEndDate = $request->request->get('endDate');

            $startDate = $strStartDate ? strtotime($strStartDate) : null;
            $endDate = $strEndDate ? strtotime($strEndDate) : null;

            $dto = new HistoricalDataRequestDto($companySymbol, $email, $startDate, $endDate);

            $errors = $this->validator->validate($dto);

            if ($errors->count() > 0) {
                $errorData = [];
                /** @var ConstraintViolation $error */
                foreach ($errors as $error) {
                    $errorData[$error->getPropertyPath()] = $error->getMessage();
                }

                return $this->render('index/index.html.twig', [
                    'errorData' => $errorData,
                    'symbols' => $symbols
                ]);
            }

            /** @var Company $company */
            $company = $this->companyService->findBySymbol($companySymbol);
            $historicalData = $this->historicalDataService->fetchHistoricalData($dto);
            $chartData = $this->historicalDataFormatter->format(
                $historicalData['prices'] ?? [],
                $dto
            );
            $data['symbol'] = $dto->getCompanySymbol();

            $this->eventDispatcher->dispatch(
                new SendInfoEmailEvent(
                      new InfoEmailDto($email, $company->getName(), $strStartDate, $strEndDate)
                ),
                SendInfoEmailEvent::NAME
            );
        }

        return $this->render('index/index.html.twig', [
            'chartData' => $chartData,
            'data' => $data,
            'symbols' => $symbols
        ]);
    }
}