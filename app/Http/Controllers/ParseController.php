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

            //Получаем ссылку на изображение
            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);


            for ($i = 0; $i < count($headings); $i++) {
                $existingProcessor = Component::where('title_component', $headings[$i])->first();

                if ($existingProcessor) {
                    $existingProcessor->config_component = $description[$i];
                    $existingProcessor->image_components = $fullImageUrls[$i];
                    $existingProcessor->id_category = 7;
                    $existingProcessor->sale = $prices[$i];

                    $existingProcessor->save();
                } else {
                    $processor = new Component();
                    $processor->title_component = $headings[$i];
                    $processor->config_component = $description[$i];
                    $processor->image_components = $fullImageUrls[$i];
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

            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);

            for ($i = 0; $i < count($headings); $i++) {
                $existingGraphicCards = Component::where('title_component', $headings[$i])->first();

                if ($existingGraphicCards) {
                    $existingGraphicCards->config_component = $description[$i];
                    $existingGraphicCards->image_components = $fullImageUrls[$i];
                    $existingGraphicCards->id_category = 6;
                    $existingGraphicCards->sale = $prices[$i];

                    $existingGraphicCards->save();
                } else {
                    $GraphicCards = new Component();
                    $GraphicCards->title_component = $headings[$i];
                    $GraphicCards->config_component = $description[$i];
                    $GraphicCards->image_components = $fullImageUrls[$i];
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

            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);

            for ($i = 0; $i < count($headings); $i++) {
                $existingMotherBoards = Component::where('title_component', $headings[$i])->first();

                if ($existingMotherBoards) {
                    $existingMotherBoards->config_component = $description[$i];
                    $existingMotherBoards->image_components = $fullImageUrls[$i];
                    $existingMotherBoards->id_category = 1;
                    $existingMotherBoards->sale = $prices[$i];

                    $existingMotherBoards->save();
                } else {
                    $MotherBoards = new Component();
                    $MotherBoards->title_component = $headings[$i];
                    $MotherBoards->config_component = $description[$i];
                    $MotherBoards->image_components = $fullImageUrls[$i];
                    $MotherBoards->id_category = 1;
                    $MotherBoards->sale = $prices[$i];

                    $MotherBoards->save();
                }
            }
        }
        return redirect('/admin');
    }

    public function ParsePowerBlock()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1225/bloki-pitaniya?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 6);

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

            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);

            for ($i = 0; $i < count($headings); $i++) {
                $existingPowerBlock = Component::where('title_component', $headings[$i])->first();

                if ($existingPowerBlock) {
                    $existingPowerBlock->config_component = $description[$i];
                    $existingPowerBlock->image_components = $fullImageUrls[$i];
                    $existingPowerBlock->id_category = 5;
                    $existingPowerBlock->sale = $prices[$i];

                    $existingPowerBlock->save();
                } else {
                    $PowerBlock = new Component();
                    $PowerBlock->title_component = $headings[$i];
                    $PowerBlock->config_component = $description[$i];
                    $PowerBlock->image_components = $fullImageUrls[$i];
                    $PowerBlock->id_category = 5;
                    $PowerBlock->sale = $prices[$i];

                    $PowerBlock->save();
                }
            }
        }
        return redirect('/admin');
    }

    public function ParseSSD()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1015/nakopiteli-ssd?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 6);

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

            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);

            for ($i = 0; $i < count($headings); $i++) {
                $existingSSD = Component::where('title_component', $headings[$i])->first();

                if ($existingSSD) {
                    $existingSSD->config_component = $description[$i];
                    $existingSSD->image_components = $fullImageUrls[$i];
                    $existingSSD->id_category = 4;
                    $existingSSD->sale = $prices[$i];

                    $existingSSD->save();
                } else {
                    $SSD = new Component();
                    $SSD->title_component = $headings[$i];
                    $SSD->config_component = $description[$i];
                    $SSD->image_components = $fullImageUrls[$i];
                    $SSD->id_category = 4;
                    $SSD->sale = $prices[$i];

                    $SSD->save();
                }
            }
        }
        return redirect('/admin');
    }

    public function ParseRAM()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1010/operativnaya-pamyat?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 6);

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

            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);

            for ($i = 0; $i < count($headings); $i++) {
                $existingRAM = Component::where('title_component', $headings[$i])->first();

                if ($existingRAM) {
                    $existingRAM->config_component = $description[$i];
                    $existingRAM->image_components = $fullImageUrls[$i];
                    $existingRAM->id_category = 3;
                    $existingRAM->sale = $prices[$i];

                    $existingRAM->save();
                } else {
                    $RAM = new Component();
                    $RAM->title_component = $headings[$i];
                    $RAM->config_component = $description[$i];
                    $RAM->image_components = $fullImageUrls[$i];
                    $RAM->id_category = 3;
                    $RAM->sale = $prices[$i];

                    $RAM->save();
                }
            }
        }
        return redirect('/admin');
    }

    public function ParseHDD()
    {
        // Создаем Guzzle клиента
        $client = new Client();

        $responses = [];

        $page = 1;

        do {
            // Отправляем GET-запрос к сайту
            $response = $client->request('GET', 'https://www.regard.ru/catalog/1014/zhestkie-diski-hdd?page=' . $page);

            // Добавляем ответ в массив ответов
            $responses[] = $response;

            $page++;
        } while ($page <= 6);

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

            $image = $crawler->filter('img.CardImageSlider_image__W65ZP')->extract(['src']);

            //Добавляем к ней ссылку сайта
            $fullImageUrls = array_map(function ($url) {
                return 'https://www.regard.ru' . $url;
            }, $image);

            for ($i = 0; $i < count($headings); $i++) {
                $existingHDD = Component::where('title_component', $headings[$i])->first();

                if ($existingHDD) {
                    $existingHDD->config_component = $description[$i];
                    $existingHDD->image_components = $fullImageUrls[$i];
                    $existingHDD->id_category = 2;
                    $existingHDD->sale = $prices[$i];

                    $existingHDD->save();
                } else {
                    $HDD = new Component();
                    $HDD->title_component = $headings[$i];
                    $HDD->config_component = $description[$i];
                    $HDD->image_components = $fullImageUrls[$i];
                    $HDD->id_category = 2;
                    $HDD->sale = $prices[$i];

                    $HDD->save();
                }
            }
        }
        return redirect('/admin');
    }
}
