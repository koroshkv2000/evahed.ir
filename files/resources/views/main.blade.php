<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Sajad Kazemi">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پیش بینی انتخاب واحد</title>

    <link href="css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="css/master.css" rel="stylesheet">


</head>
<body class="bg-light">

<div class="container-sm">
    <main>
        <div class=" text-center">
            <img class="d-block mx-auto mb-4 mt-5" src="icon/ballot-check.svg" alt="" width="72" height="57">
            <h1>ابزار انتخاب واحد</h1>
            <p class="lead mb-4">سلام دوستای خوبم این ابزار هوشمند انتخاب واحده که توسط خودم و با ذوق شخصی توسعه پیدا کرده و صرفا جهت سهولت در پیش بینی و یا برنامه ریزی صحیح انتخاب واحد تصمیم گرفتم که راه‌اندازی بشه</p>
            <div class="alert alert-warning d-flex  mb-5" role="alert">
                <div>
                    فقط دوست خوبم حواست به این نکته باشه که این سایت فعلا برای <strong>دانشگاه آزاد قزوین</strong> پیاده سازی شده و <strong>ممکنه که قوانین موجود در سایت با چارت دانشگاه دیگه نخوره</strong> :( پس فعلا اگه دانشگاهت فرق داره سعی کن که از سایت استفاده نکنی شاید گمراه بشی. فعلا هم برای رشته کامپیوتر طراحی و پیاده سازی امیدوارم که حمایت بشه تا بقیه رشته ها هم بتونم پوشش بدم
                </div>
            </div>
            <div class="alert alert-primary d-flex step step-1 hidden" role="alert">
                <div>
                    خب دوست خوب من اولین قدمی که باید برداری برای انتخاب واحد اینه که به من بگی <strong>چه رشته ای درس میخونی</strong>.
                </div>
            </div>

            <div class="alert alert-primary d-flex step step-2 hidden" role="alert">
                <div>
                    خب خوبه! حالا <strong>گرایش تحصیلی</strong> که مد نظر داری رو بهم بگو تا بتونم درساتو پیدا کنم
                </div>
            </div>
            <div class="alert alert-primary d-flex step step-3 hidden" role="alert">
                <div>
                    خب حالا درساتو تونستم پیدا کنم! فقط الان <strong>درسایی که تا حالا پاس کردی</strong> رو باید بهم بگی
                </div>
            </div>
        </div>

        <div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5 mb-2" id="major-box">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <select class="form-select hidden ">
                            <option value="">انتخاب رشته تحصیلی...</option>
                        </select>
                        <div class="invalid-feedback"  >اینجا باید یه رشته تحصیلی انتخاب کنی:)</div>
                    </div>
                    <div class="col-md-5 mb-2 hidden" id="branch-box">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <select class="form-select hidden ">
                            <option value="">انتخاب رشته تحصیلی...</option>
                        </select>
                        <div class="invalid-feedback"  >اینجا باید یه رشته تحصیلی انتخاب کنی:)</div>
                    </div>
                    <div class="col-md-2 mb-2 hidden" id="count-box"><span>تعداد واحد: 144</span></div>
                    <div class="col-md-12">
                        <div class="row" id="course-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1"> توسعه یافته توسط <a href="https://t.me/koroshkv">سجاد 3></a></p>

    </footer>
</div>


<script src="/js/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="/js/master.js"></script>



</body>
</html>
