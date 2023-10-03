<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>QR Code Generator</title>
  <link rel="stylesheet" href="{{asset('assets/code/style.css') }}">
  <!-- ./style.css -->

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
  <header>
    <h1>Code Qr parain </h1>
    <p>Collez une URL ou entrez du texte pour creer un code QR
    </p>
  </header>
  <div class="form">
    <input type="text" spellcheck="false" placeholder="Entre le text ou le liens url ">
    <button>Generer Code QR</button>
  </div>
  <div class="qr-code">
    <img src="" alt="qr-code">
  </div>
</div>
<!-- partial -->
  <script  src="{{ asset('assets/code/script.js') }}"></script>

</body>
</html>
