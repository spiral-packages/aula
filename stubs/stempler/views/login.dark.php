<extends:auth.layouts.app/>

<block:content>
    <form action="/login" method="POST">
        <input placeholder="Email..." name="email" type="text">
        <input placeholder="Password..." name="password" type="text">
        <button type="submit">Login</button>
    </form>
</block:content>
