<extends:auth.layouts.app/>

<block:content>
    <form action="/login" method="POST">
        <input placeholder="Login..." name="username" type="text">
        <input placeholder="Password..." name="password" type="text">
        <button type="submit">Submit</button>
    </form>
</block:content>
