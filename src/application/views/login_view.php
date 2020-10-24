<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="">
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description"
          content="Сайт для создания и обработки аттестационных ведомостей">
    <link rel="stylesheet"
          type="text/css"
          href="css/styles.css">
    <title>AttestationSheets</title>
</head>
<body class="login-page-bgimg">
<!--<header class=" w3-display-container " id="home">
    <div class="w3-display-bottomleft w3-padding">
        <span class="w3-tag w3-xlarge">Пожалуйста, войдите в Ваш аккаунт</span>
    </div>
    <div class="w3-display-middle w3-center">
        <span class="w3-text-black w3-hide-small" style="font-size:100px;font-family:'MoneyMoney' ;">$mart<br>Expen$es</span>
        <span class="w3-text-white w3-hide-large w3-hide-medium" style="font-size:60px"><b>$mart<br>Expen$es</b></span>
        <p><button onclick="document.getElementById('login_modal').style.display='block'" class="w3-button w3-margin w3-xxlarge w3-black">Login</button>
            <button onclick="document.getElementById('signup_modal').style.display='block'" class="w3-button w3-margin w3-xxlarge w3-black">Sign Up</button></p>
    </div>
</header>-->

<div class="w3-display-bottomleft w3-padding">
    <span class="w3-card w3-pale-yellow w3-xlarge">Пожалуйста, войдите в Ваш аккаунт</span>
</div>
<div class="main">
    <div id="login-page-title"
         class="display-middle text-shadowed no-wrap">
        Attestation Sheets
    </div>
    <button id="login-button"
            onclick="document.getElementById('login_modal').style.display='block'"
            class="login-btns w3-button  w3-xxlarge w3-khaki">Login
    </button>
    <button id="signup-button"
            onclick="document.getElementById('signup_modal').style.display='block'"
            class="login-btns w3-button  w3-xxlarge w3-khaki">Sign Up
    </button>
    <div class="w3-container">
        <div id="login_modal" class="w3-modal">
            <div id="login_card"
                 class="w3-modal-content w3-card-4 w3-animate-zoom"
                 style="max-width:600px; padding-top: 5px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('login_modal').style.display='none'"
                          class="w3-button w3-xlarge w3-transparent w3-display-topright"
                          title="Close Modal">×</span>
                    <img src="../images/img_avatar.png"
к                         alt="Avatar"
                         style="width:30%"
                         class="w3-circle w3-margin-top">
                </div>

                <form id="login_form"
                      method="post"
                      class="w3-container"
                      action="/login">
                    <div id="login_div"
                         class="w3-section">
                        <label><b>Login</b></label>
                        <input id="login"
                               class="w3-input w3-border w3-margin-bottom"
                               autofocus="true"
                               type="text"
                               placeholder="Enter login"
                               name="user_login"
                               required>
                        <label><b>Password</b></label>
                        <input id="password"
                               class="w3-input w3-border"
                               type="password"
                               placeholder="Enter Password"
                               name="user_password"
                               required>
                        <button id="submit"
                                class="w3-button w3-block w3-yellow w3-section w3-padding"
                                type="submit">Login
                        </button>


                    </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('login_modal').style.display='none'"
                            type="button"
                            class="w3-button w3-red">Cancel
                    </button>

                </div>

            </div>
        </div>
        <div id="signup_modal"
             class="w3-modal"
             style="padding-top:5px">
            <div id="signup_card"
                 class="w3-modal-content w3-card-4 w3-animate-zoom"
                 style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('signup_modal').style.display='none'"
                          class="w3-button w3-xlarge w3-transparent w3-display-topright"
                          title="Close Modal">×</span>
                    <img src="../images/img_avatar.png"
                         alt="Avatar"
                         style="width:30%"
                         class="w3-circle w3-margin-top">
                </div>

                <form id="signup_form"
                      method="post"
                      class="w3-container"
                      action="/signup">
                    <div id="signup_div"
                         class="w3-section">
                        <label><b>Userlogin</b></label>
                        <input id="username_signup"
                               class="w3-input w3-border w3-margin-bottom"
                               autofocus="true"
                               type="text"
                               placeholder="Enter Username"
                               name="user_login"
                               required>
                        <!--<label><b>Email</b></label>
                        <input id="login_signup"
                               class="w3-input w3-border w3-margin-bottom"
                               autofocus="true"
                               type="text"
                               placeholder="Enter email"
                               name="user_email"
                               required>-->
                        <label><b>Password</b></label>
                        <input id="password_signup"
                               class="w3-input w3-border"
                               type="password"
                               placeholder="Enter Password"
                               name="user_password"
                               required>
                        <button id="submit_signup"
                                class="w3-button w3-block w3-yellow w3-section w3-padding"
                                type="submit">Sign Up
                        </button>


                    </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                    <button onclick="document.getElementById('signup_modal').style.display='none'"
                            type="button"
                            class="w3-button w3-red">Cancel
                    </button>

                </div>

            </div>
        </div>
    </div>
    <?php
        if(!empty($response)) echo $response; ?>
    <!--<a href="/sheets" id="login-button" class="card w3-orange login-btns w3-xlarge" >Войти</a>
    <a id="signup-button" class="card w3-orange login-btns w3-xlarge">Зарегистрироваться</a>-->
</div>
</body>
</html>