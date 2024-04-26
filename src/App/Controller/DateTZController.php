<?php

namespace App\Controller;

use App\Form\DateTZ;
use App\Service\DateTZService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/date-tz", name="dateTZ_")
 */
class DateTZController extends AbstractController
{
    /**
     * @Route("/info", name="info")
     */
    public function info(
        Request $request,
        DateTZService $dateTZService
    ): Response {

        $resultData = [];

        $form = $this->createForm(DateTZ\InfoType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            //////////

            $dateTime = \DateTime::createFromFormat('Y-m-d', $formData['date']);
            $timezone = $formData['timezone'];

            try {
                $offset = $dateTZService->getOffsetFromUTC($timezone);
            } catch (\Exception $e) {
                $form->addError(new FormError(
                    \sprintf('Timezone `%s` can\'t be processed properly: (%s) %s', $timezone, $e->getCode(), $e->getMessage())
                ));
                $offset = '[?]';
            }

            $resultData = [
                'timezone' => $timezone,
                'offset' => $offset,
                'month' => $dateTime->format('F'),
                'daysInMonth' => $dateTime->format('t'),
                'daysInFebruary' => $dateTZService->getDaysInFebruary($dateTime->format('Y')),
            ];

        }

        return $this->render('date-tz-info/index.html.twig', [
            'form' => $form->createView(),
            'result' => $resultData,
        ]);
    }

}
