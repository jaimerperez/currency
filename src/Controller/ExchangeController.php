<?php

namespace App\Controller;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Form\AmountType;

class ExchangeController extends AbstractController
{
    private const BASE_URL = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies';
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    #[Route('/', name: 'app_exchange')]
    public function new(Request $request,HttpClientInterface $httpClient): Response
    {  
        $task = new Task();
        $operation = null;
       
        $arrayCurrency = $this-> getCurrencies($httpClient);
        $currency = array_values($arrayCurrency);
        
        $form = $this->createForm(AmountType::class, $task,[
            'currency_names' => array_combine($currency, $currency)
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $toValue =  $task->getTo();
            $fromValue = $task->getFrom();
            $amountValue = $task->getAmount();


            $keyFoundTo = array_search($toValue, $arrayCurrency);
            $keyFoundFrom = array_search($fromValue, $arrayCurrency);
            $baseCurrency = $this->getValues($httpClient,$keyFoundTo,self::BASE_URL.'/'.$keyFoundFrom.'/'.$keyFoundTo.'.json');
            $operation = $amountValue * $baseCurrency;
        }
        return $this->render('exchange/new.html.twig', [
            'form' => $form,
            'value' => $operation
        ]);
    }
    private function getValues(HttpClientInterface $httpClient,string $keyTo,string $url): int {
        $response = $httpClient->request('GET', $url);
        $data = $response->toArray();
        $baseCurrency = $data[$keyTo];
        return $baseCurrency;
    }
    private function getCurrencies(HttpClientInterface $httpClient): array {
        $response = $httpClient->request('GET',self::BASE_URL .'.json');
        return $response->toArray();
    }
}
