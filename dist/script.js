$(document).ready(function () {
    var home_url = $("#home_url").val();
    var back_url = home_url + "include/back.php";
    $("#summernote").summernote({
        lang: "fa-IR",
        placeholder: "اینجا بنویس...",
        height: 300,
        useProtocol: false,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["link", "picture"]],
            ["view", ["fullscreen", "codeview"]],
        ],
        styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre'],
        callbacks: {
            onCreateLink: function (originalUrl) {
                // 👇 اگر ایمیل یا تلفن بود، تغییر نده
                if (/^(mailto:|tel:)/i.test(originalUrl)) {
                    return originalUrl;
                }

                // 👇 اگر لینک نسبی بود (شروع با / یا #)، تغییر نده
                if (/^(\/|#)/.test(originalUrl)) {
                    return originalUrl;
                }

                // 👇 اگر از قبل پروتکل http یا https داشت، تغییر نده
                if (/^https?:\/\//i.test(originalUrl)) {
                    return originalUrl;
                }

                // 👇 در سایر موارد، https:// اضافه کن
                return "https://" + originalUrl;
            },
        },
    });

    $("#contentForm").submit(function (e) {
        e.preventDefault();

        const title = $('input[name="title"]').val();
        const htmlContent = $("#summernote").summernote("code");
        const formData = new FormData();

        formData.append('title', title);
        formData.append("content", htmlContent);

        $.ajax({
            url: back_url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                Swal.fire("✅ موفقیت", response, "success");
                $("#summernote").summernote("reset");
                $('#contentForm')[0].reset();
            },

            error: function () {
                Swal.fire("❌ خطا", "در ذخیره اطلاعات مشکلی پیش آمد!", "error");
            },
        });
    });
});
