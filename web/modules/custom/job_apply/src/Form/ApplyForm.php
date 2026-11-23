<?php

namespace Drupal\job_apply\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ApplyForm extends FormBase {

  public function getFormId() {
    return 'job_apply_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = ['#type' => 'textfield', '#title' => $this->t('Full name'), '#required' => TRUE];
    $form['email'] = ['#type' => 'email', '#title' => $this->t('Email'), '#required' => TRUE];
    $form['job'] = ['#type' => 'textfield', '#title' => $this->t('Job title'), '#required' => TRUE];
    $form['submit'] = ['#type' => 'submit', '#value' => $this->t('Submit application')];
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('name')) < 3) {
      $form_state->setErrorByName('name', $this->t('Please enter your full name.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::database()->insert('job_application')->fields([
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'job' => $form_state->getValue('job'),
      'created' => \Drupal::time()->getRequestTime(),
    ])->execute();
    $this->messenger()->addStatus($this->t('Thank you! Your application has been received.'));
  }

}
