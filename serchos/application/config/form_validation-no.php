<?php 
$config = array(
    'inicio/login' => array(
        array( 'field' => 'usuario', 'label' => 'usuario', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
        array( 'field' => 'contra', 'label' => 'contra', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
    ),
    'inicio/registro' => array(
        array( 'field' => 'nombre', 'label' => 'nombre', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
        array( 'field' => 'paterno', 'label' => 'paterno', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
        array( 'field' => 'materno', 'label' => 'materno', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
        array( 'field' => 'usuario', 'label' => 'usuario', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
        array( 'field' => 'contra', 'label' => 'contra', 'rules' => 'required|trim', 'errors' => array( 'required' => 'r-{field}' ) ),
        array( 'field' => 'confcontra', 'label' => 'confcontra', 'rules' => 'required|trim|matches[contra]', 'errors' => array( 'required' => 'r-{field}', 'matches' => 'm-{field}' ) )
    )
);