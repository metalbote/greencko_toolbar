<?php

/**
 * @file
 * Contains \Drupal\webiteasy_toolbar\Form\WebiteasyToolbarSettingsForm.
 */

namespace Drupal\greencko_toolbar\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class GreenckoToolbarSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'greencko_toolbar_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['greencko_toolbar.settings',];
  }


  /**
   * {@inheritdoc}
   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->configFactory->get('greencko_toolbar.settings');

    $form['appearance'] = array(
      '#type' => 'details',
      '#title' => $this->t('Appearance'),
      '#open' => TRUE,
    );
    $form['appearance']['labels'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Labels on Toolbar'),
      '#default_value' => $config->get('appearance.labels'),
    );

    $form['menu'] = array(
      '#type' => 'details',
      '#title' => $this->t('Toolbar Items'),
      '#open' => TRUE,
    );
    $form['menu']['greencko'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show greencko Menu on Toolbar'),
      '#default_value' => $config->get('menu.greencko'),
    );
    $form['menu']['drupal'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show Drupal Menu on Toolbar'),
      '#default_value' => $config->get('menu.drupal'),
    );
    $form['menu']['add'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show add content on Toolbar'),
      '#default_value' => $config->get('menu.add'),
    );
    $form['menu']['edit'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show edit content on Toolbar'),
      '#default_value' => $config->get('menu.edit'),
    );
    $form['menu']['translate'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show translate content on Toolbar'),
      '#default_value' => $config->get('menu.translate'),
    );
    $form['menu']['content'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show content overview on Toolbar'),
      '#default_value' => $config->get('menu.content'),
    );
    $form['menu']['menus'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show menu on Toolbar'),
      '#default_value' => $config->get('menu.menus'),
    );
    $form['menu']['taxonomy'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show taxonomy on Toolbar'),
      '#default_value' => $config->get('menu.taxonomy'),
    );
    $form['menu']['reports'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show reports on Toolbar'),
      '#default_value' => $config->get('menu.reports'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory->getEditable('greencko_toolbar.settings');

    $config
      ->set('appearance.labels', $form_state->getValue('labels'))
      ->set('menu.greencko', $form_state->getValue('greencko'))
      ->set('menu.drupal', $form_state->getValue('drupal'))
      ->set('menu.add', $form_state->getValue('add'))
      ->set('menu.edit', $form_state->getValue('edit'))
      ->set('menu.translate', $form_state->getValue('translate'))
      ->set('menu.content', $form_state->getValue('content'))
      ->set('menu.menus', $form_state->getValue('menus'))
      ->set('menu.taxonomy', $form_state->getValue('taxonomy'))
      ->set('menu.reports', $form_state->getValue('reports'));


    $config->save();

    parent::submitForm($form, $form_state);
    drupal_flush_all_caches();
  }
}