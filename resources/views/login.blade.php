<form action="{{route('postlogin')}}" method="post">
    @csrf
    <div>
        <label for="name">enter email</label>
         <input type="text" name="email" placeholder="enter email" required>
    </div>
    <div>
        <label for="password">password</label>
        <input type="text" name="password" placeholder="password" required>
    </div>
    <div>
        <select name="role" id="">
            <option value="1">Admin</option>
            <option value="0">User</option>
        </select>
    </div>
    <div>
        <button type="submit"> submit</button>
    </div>
    <div>
        @if(session('msg2'))
            {{session('msg2')}}
        @endif
    </div>
    <div>
        @if(session('msg1'))
            <a href="{{route('Register')}}"> Not a user? {{session('msg1')}}</a>
        @endif
    </div>
</form>