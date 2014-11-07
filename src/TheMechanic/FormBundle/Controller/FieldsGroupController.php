<?php

namespace TheMechanic\FormBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TheMechanic\FormBundle\Entity\FieldsGroup;
use TheMechanic\FormBundle\Form\FieldsGroupType;

/**
 * FieldsGroup controller.
 *
 */
class FieldsGroupController extends Controller
{

    /**
     * Lists all FieldsGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FormBundle:FieldsGroup')->findAll();

        return $this->render('FormBundle:FieldsGroup:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FieldsGroup entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FieldsGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fieldsgroup_show', array('id' => $entity->getId())));
        }

        return $this->render('FormBundle:FieldsGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a FieldsGroup entity.
     *
     * @param FieldsGroup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FieldsGroup $entity)
    {
        $form = $this->createForm(new FieldsGroupType(), $entity, array(
            'action' => $this->generateUrl('fieldsgroup_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FieldsGroup entity.
     *
     */
    public function newAction()
    {
        $entity = new FieldsGroup();
        $form   = $this->createCreateForm($entity);

        return $this->render('FormBundle:FieldsGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FieldsGroup entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormBundle:FieldsGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FieldsGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormBundle:FieldsGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FieldsGroup entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormBundle:FieldsGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FieldsGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FormBundle:FieldsGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FieldsGroup entity.
    *
    * @param FieldsGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FieldsGroup $entity)
    {
        $form = $this->createForm(new FieldsGroupType(), $entity, array(
            'action' => $this->generateUrl('fieldsgroup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FieldsGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FormBundle:FieldsGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FieldsGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fieldsgroup_edit', array('id' => $id)));
        }

        return $this->render('FormBundle:FieldsGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FieldsGroup entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FormBundle:FieldsGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FieldsGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fieldsgroup'));
    }

    /**
     * Creates a form to delete a FieldsGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fieldsgroup_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
