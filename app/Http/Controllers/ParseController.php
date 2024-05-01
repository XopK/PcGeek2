<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ParseController extends Controller
{
    public function ParseProcessor()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1001/processory?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 7);

        // Обрабатываем каждый ответ
        foreach ($responses as $response) {
            // Получаем HTML-контент
            $htmlContent = $response->getBody()->getContents();

            // Создаем экземпляр DomCrawler и передаем ему HTML-контент
            $crawler = new Crawler($htmlContent);

            $headings = $crawler->filter('.CardText_title__7bSbO')->each(function ($node) {
                return $node->text();
            });

            $prices = $crawler->filter('.Price_price__m2aSe')->each(function ($node) {
                return $node->text();
            });

            $description = $crawler->filter('.CardText_text__fZPl_')->each(function ($node) {
                return $node->text();
            });

            for ($i = 0; $i < count($headings); $i++) {
                $existingProcessor = Component::where('title_component', $headings[$i])->first();

                if ($existingProcessor) {
                    $existingProcessor->config_component = $description[$i];
                    $existingProcessor->image_components = 'test';
                    $existingProcessor->id_category = 7;
                    $existingProcessor->sale = $prices[$i];

                    $existingProcessor->save();
                } else {
                    $processor = new Component();
                    $processor->title_component = $headings[$i];
                    $processor->config_component = $description[$i];
                    $processor->image_components = 'test';
                    $processor->id_category = 7;
                    $processor->sale = $prices[$i];

                    $processor->save();
                }
            }
        }
        return redirect('/admin');
    }

    public function ParseGraphicCards()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1013/videokarty?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 8);

        // Обрабатываем каждый ответ
        foreach ($responses as $response) {
            // Получаем HTML-контент
            $htmlContent = $response->getBody()->getContents();

            // Создаем экземпляр DomCrawler и передаем ему HTML-контент
            $crawler = new Crawler($htmlContent);

            $headings = $crawler->filter('.CardText_title__7bSbO')->each(function ($node) {
                return $node->text();
            });

            $prices = $crawler->filter('.Price_price__m2aSe')->each(function ($node) {
                return $node->text();
            });

            $description = $crawler->filter('.CardText_text__fZPl_')->each(function ($node) {
                return $node->text();
            });

            for ($i = 0; $i < count($headings); $i++) {
                $existingGraphicCards = Component::where('title_component', $headings[$i])->first();

                if ($existingGraphicCards) {
                    $existingGraphicCards->config_component = $description[$i];
                    $existingGraphicCards->image_components = 'test2';
                    $existingGraphicCards->id_category = 6;
                    $existingGraphicCards->sale = $prices[$i];

                    $existingGraphicCards->save();
                } else {
                    $GraphicCards = new Component();
                    $GraphicCards->title_component = $headings[$i];
                    $GraphicCards->config_component = $description[$i];
                    $GraphicCards->image_components = 'test2';
                    $GraphicCards->id_category = 6;
                    $GraphicCards->sale = $prices[$i];

                    $GraphicCards->save();
                }
            }
        }
        return redirect('/admin');
    }

    public function ParseMotherBoards()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1000/materinskie-platy?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 7);

        // Обрабатываем каждый ответ
        foreach ($responses as $response) {
            // Получаем HTML-контент
            $htmlContent = $response->getBody()->getContents();

            // Создаем экземпляр DomCrawler и передаем ему HTML-контент
            $crawler = new Crawler($htmlContent);

            $headings = $crawler->filter('.CardText_title__7bSbO')->each(function ($node) {
                return $node->text();
            });

            $prices = $crawler->filter('.Price_price__m2aSe')->each(function ($node) {
                return $node->text();
            });

            $description = $crawler->filter('.CardText_text__fZPl_')->each(function ($node) {
                return $node->text();
            });

            for ($i = 0; $i < count($headings); $i++) {
                $existingMotherBoards = Component::where('title_component', $headings[$i])->first();

                if ($existingMotherBoards) {
                    $existingMotherBoards->config_component = $description[$i];
                    $existingMotherBoards->image_components = 'test3';
                    $existingMotherBoards->id_category = 1;
                    $existingMotherBoards->sale = $prices[$i];

                    $existingMotherBoards->save();
                } else {
                    $MotherBoards = new Component();
                    $MotherBoards->title_component = $headings[$i];
                    $MotherBoards->config_component = $description[$i];
                    $MotherBoards->image_components = 'test3';
                    $MotherBoards->id_category = 1;
                    $MotherBoards->sale = $prices[$i];

                    $MotherBoards->save();
                }
            }
        }
        return redirect('/admin');
    }
}
