<form method="POST" action="{{ route('EmpAcc.store') }}">
    @csrf
    <div>
        <label for="usenrame">Username</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="department">Department</label>
        <input type="text" name="department" id="department" required>
    </div>
    <button type="submit">Register</button>
</form>
