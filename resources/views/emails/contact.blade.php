<!DOCTYPE HTML>
<html lang="en">
<body>

  <h1>New message from {{ $cont[0] }}</h1>

  <p>{{ $cont[1] }}</p>

  @if(!empty($cont[2]))
  <p>{{ $cont[2] }}</p>
  @endif

</body>
</html>
