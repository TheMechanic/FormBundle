<?php

namespace TheMechanic\FormBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\NotBlank;

use TheMechanic\FormBundle\Entity\FieldsGroup;
use TheMechanic\FormBundle\Entity\Answer;
use TheMechanic\FormBundle\Entity\Answerline;

class DefaultController extends Controller
{

    /**
     * [indexAction description]
     * @return [type] [description]
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $em->getRepository('FormBundle:Form')->find(1);

        if (!$form)
            throw $this->createNotFoundException('Unable to find Form entity.');

        $dynamicForm = $this->createDynamicForm($form);

        $dynamicForm->handleRequest($request);

        if ($dynamicForm->isValid()) {
            $data = $dynamicForm->getData();
            $this->persistAnswer($form, $data);
            echo "Form submited :)";
            die;
        }

        return $this->render('FormBundle:Default:index.html.twig', array(
            'form' => $dynamicForm->createView(),
        ));
    }

    /**
     * [createDynamicForm description]
     * @param  [type] $form [description]
     * @return [type]       [description]
     */
    private function createDynamicForm($form)
    {
        $formOjbect = $this->createFormBuilder();

        foreach ($form->getFields() as $field) {
            if ($field->getFieldGroup()->getId() === null) {
                $constraints = array();

                if ($field->getIsRequired())
                    $constraints[] = new NotBlank();

                $formOjbect->add('field-' . $field->getId(), $field->getType(), array(
                    'label' => $field->getLabel(),
                    'required' => $field->getIsRequired(),
                    'constraints' => $constraints,
                ));
            }
        }

        foreach ($form->getFieldsGroups() as $fg) {
            $formOjbect->add('title-' . $fg->getId(), 'text', array(
                    'label'     => $fg->getLabel(),
                    'required'  => false,
                    'read_only' => true,
                    'disabled'  => true,
                ));
            foreach ($fg->getFields() as $field) {
                $constraints = array();

                if ($field->getIsRequired())
                    $constraints[] = new NotBlank();

                $formOjbect->add('field-' . $field->getId(), $field->getType(), array(
                    'label' => $field->getLabel(),
                    'required' => $field->getIsRequired(),
                    'constraints' => $constraints,
                ));
            }
        }

        $formOjbect->add('submit', 'submit');

        return $formOjbect->getForm();
    }

    private function persistAnswer($form, $data)
    {
        $em = $this->getDoctrine()->getManager();
        $answer = new Answer();
        $answer->setForm($form);
        
        foreach ($data as $key => $value) {
            $fieldId = explode('-', $key)[1];
            $field = $em->getRepository('FormBundle:Field')->find($fieldId);
            if (!$field)
                throw $this->createNotFoundException('Unable to find Field entity.');

            $Answerline = new Answerline();
            $Answerline->setField($field);
            $Answerline->setValue($value);
            $answer->addAnswerline($Answerline);
        }

        $em->persist($answer);
        $em->flush();
    }
}
