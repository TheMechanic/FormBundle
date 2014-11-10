<?php

namespace TheMechanic\FormBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefaultController extends Controller
{

    /**
     * [indexAction description]
     * @return [type] [description]
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $em->getRepository('FormBundle:Form')->find(5);

        if (!$form)
            throw $this->createNotFoundException('Unable to find Form entity.');

        $dynamicForm = $this->createDynamicForm($form);

        $dynamicForm->handleRequest($request);

        if ($dynamicForm->isValid()) {
            $data = $dynamicForm->getData();
            var_dump($data);
            $this->persistAnswer($form, $data);
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
            $constraints = array();
            if ($field->getIsRequired())
                $constraints[] = new NotBlank();
            $formOjbect->add($field->getName(), $field->getType(), array(
                'required' => $field->getIsRequired(),
                'constraints' => $constraints,
            ));
        }

        foreach ($form->getFieldsGroups() as $fg) {
            foreach ($fg->getFields() as $field) {
                $constraints = array();
                if ($field->getIsRequired())
                    $constraints[] = new NotBlank();
                $formOjbect->add($field->getName(), $field->getType(), array(
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
        
    }
}
