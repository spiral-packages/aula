<extends:auth.layouts.app/>

<block:content>
    <form action="/register" method="POST">
        <input placeholder="Email..." name="email" type="text">
        <input placeholder="Password..." name="password" type="text">
        <input placeholder="Confirm password..." name="confirmPassword" type="text">
        <button type="submit">Register</button>
    </form>
</block:content>
