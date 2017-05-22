<!DOCTYPE HTML>
<html lang="en">
<body>

  @if(!empty($cont[0]))
  <h1>New message from {{ $cont[0] }}</h1>
  @endif

  @if(!empty($cont[1]))
  <p>{{ $cont[1] }}</p>
  @endif

  @if(!empty($cont[2]))
  <p>{{ $cont[2] }}</p>
  @endif

</body>
</html>
