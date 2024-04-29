<?php

namespace App\Controller;

use App\Form\DateTZ\InfoFormModel;
use App\Form\DateTZ\InfoType;
use App\Service\DateTZService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/date-tz-", name="date-tz-")
 */
class DateTZController extends AbstractController
{
    /**
     *
     * @Route("info", name="info")
     *
     * @param Request $request
     * @param DateTZService $dateTZService
     * @return Response
     * @throws Exception
     */
    public function infoForm(
        Request $request,
        DateTZService $dateTZService
    ): Response {

        $form = $this->createForm(InfoType::class, new InfoFormModel());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var InfoFormModel $formData */
            $infoFormModel = $form->getData();

            //////////

            $result = [
                'timezone' => $infoFormModel->timeZone->getName(),
                'offset' => $dateTZService->getTimeZoneOffsetInMinutes($infoFormModel->timeZone),
                'month' => $dateTZService->getNameOfMonth($infoFormModel->date),
                'daysInMonth' => $dateTZService->getDaysInMonth($infoFormModel->date),
                'daysInFebruary' => $dateTZService->getDaysInFebruary($infoFormModel->date),
            ];

        }

        return $this->render('date-tz/info.html.twig', [
            'form' => $form->createView(),
            'result' => $result ?? [],
        ]);
    }

}
