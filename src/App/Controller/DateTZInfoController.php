<?php

namespace App\Controller;

use App\Form\DateTZInfoFormModel;
use App\Form\DateTZInfoType;
use App\Service\DateTZService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/date-tz-info", name="date-tz-info")
 */
class DateTZInfoController extends AbstractController
{
    /**
     *
     * @param Request $request
     * @param DateTZService $dateTZService
     * @return Response
     */
    public function __invoke(
        Request $request,
        DateTZService $dateTZService
    ): Response {

        $result = [];

        $form = $this->createForm(DateTZInfoType::class, new DateTZInfoFormModel());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var DateTZInfoFormModel $formData */
            $formData = $form->getData();

            //////////

            $dateTime = \DateTime::createFromFormat('Y-m-d', $formData->date);

            try {
                $offset = $dateTZService->getOffsetFromUTC($formData->timezone);
                $offset = $offset / 60;
            } catch (\Exception $e) {
                $form->addError(new FormError(
                    \sprintf('Timezone `%s` can\'t be processed properly: (%s) %s', $formData->timezone, $e->getCode(), $e->getMessage())
                ));
                $offset = '[?]';
            }

            $result = [
                'timezone' => $formData->timezone,
                'offset' => $offset,
                'month' => $dateTime->format('F'),
                'daysInMonth' => $dateTime->format('t'),
                'daysInFebruary' => $dateTZService->getDaysInFebruaryByYear($dateTime->format('Y')),
            ];

        }

        return $this->render('date-tz-info.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }

}
