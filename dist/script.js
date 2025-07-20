$(document).ready(function () {
  var home_url = $('#home_url').val();
  var back_url = home_url + 'include/back.php';
  $('#summernote').summernote({
    placeholder: 'اینجا بنویس...',
    height: 300,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'picture']],
      ['view', ['fullscreen', 'codeview']],
    ],
    styleTags: ['p', 'h1', 'h2', 'h3'],
  });

  $('#contentForm').submit(function (e) {
    e.preventDefault();

    const htmlContent = $('#summernote').summernote('code');
    const formData = new FormData();
    formData.append('content', htmlContent);

    $.ajax({
      url: back_url,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,

      success: function (response) {
        Swal.fire('✅ موفقیت', response, 'success');
        $('#summernote').summernote('reset');
      },

      error: function () {
        Swal.fire('❌ خطا', 'در ذخیره اطلاعات مشکلی پیش آمد!', 'error');
      },
    });
  });
});