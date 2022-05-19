<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>



<link rel="stylesheet" href='/css/style.css' type="text/css" />
<link rel="icon" href="/img/icon-page.png">

<body>
    <div class="form-geral">
        <div>
            <div>
                <div class="box-error">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <div class="error-message">
                        <img src="/img/error.png" alt="error icon" id="error-icon">
                        <p>{{ $error }}</p>
                    </div>
                    @endforeach
                    @endif
                    @if(session('mensagem'))
                    <div class="success-message">
                        <img src="/img/success.png" alt="success icon" id="success-icon">
                        <p>{{session('mensagem')}}</p>
                    </div>
                    @endif
                </div>
            </div>
            <form action="/contact" method="POST">
                <div>
                    <label for="name">
                        <img src="/img/icon.png" alt="icon">
                    </label>
                    <input type="text" name="name" id="name" placeholder="Name" value="{{old('name')}}">
                </div>

                <div>
                    <label for="email">
                        <img src="img/email.png" alt="email icon" />
                    </label>
                    <input type="text" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                </div>

                <div>
                    <label for="message">
                        <img src="img/message.png" alt="message icon" />
                    </label>
                    <textarea type="text" name="message" id="message" placeholder="Message" cols="40" rows="5">{{old('message')}}</textarea>
                </div>

                <button name="botton-submit" id="botton-submit" class="botton-submit" type="submit">Send</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
        </div>
    </div>
</body>

</html>