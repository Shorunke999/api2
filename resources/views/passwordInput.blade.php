<form action="post" action="{{route('setpasswordandauth')}}">
    @csrf
    <input type="text" name="password" required>
    <input type="hidden" name="emal#il" value="{{$email}}">
    <button type="submit">submit password</button>
</form>