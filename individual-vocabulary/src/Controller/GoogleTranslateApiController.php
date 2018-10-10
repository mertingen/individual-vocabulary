<?php

namespace App\Controller;

use Google\Cloud\Translate\TranslateClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GoogleTranslateApiController
 * @package App\Controller
 *
 * @Security("has_role('ROLE_USER')")
 */
class GoogleTranslateApiController extends AbstractController
{
    /**
     * @Route("/google/translate/api", name="google_translate_api")
     *
     * It returns the languages of translate.
     */
    public function index()
    {
        $translate = new TranslateClient();
        $targetLanguage = 'en';
        $result = $translate->localizedLanguages([
            'target' => $targetLanguage,
        ]);

        $languages = array();
        foreach ($result as $lang) {
            $languages[] = array(
                'id' => $lang['code'],
                'text' => $lang['name']
            );
        }

        return new JsonResponse(
            array(
                'status' => true,
                'languages' => $languages
            ), 200);
    }
}
