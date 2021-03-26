<?php
session_start();
?>

<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <label class="mdc-text-field mdc-text-field--filled">
  <span class="mdc-text-field__ripple"></span>
  <span class="mdc-floating-label" id="my-label-id">My Label</span>
  <input class="mdc-text-field__input" type="text" aria-labelledby="my-label-id" maxlength="10">
  <span class="mdc-line-ripple"></span>
</label>
<div class="mdc-text-field-helper-line">
  <div class="mdc-text-field-character-counter">0 / 10</div>
</div>