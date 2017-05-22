<!DOCTYPE HTML>
<html lang="en">
<body>

  <h1>New message from {{ $cont[0] }}</h1>

  @if(!empty($cont[1]))
  <p>{{ $cont[1] }}</p>
  @endif

  @if(!empty($cont[2]))
  <p>{{ $cont[2] }}</p>
  @endif

</body>
</html>
