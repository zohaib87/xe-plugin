<?php 
/**
 * Set required variables.
 *
 * @package Xe Plugin
 */

$this->path         =   ABSPATH . 'wp-content/plugins/xe-plugin';
$this->url          =   plugins_url() . '/xe-plugin';
$this->plugin       =   get_plugin_data($this->path.'/xe-plugin.php');

$this->inc          =   $this->path . '/includes';
$this->ext          =   $this->path . '/extensions';
$this->srt          =   $this->path . '/shortcodes';
$this->css          =   $this->url . '/assets/css';
$this->js           =   $this->url . '/assets/js';
$this->img          =   $this->url . '/assets/img';
