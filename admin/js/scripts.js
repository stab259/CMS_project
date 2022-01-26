$(document).ready(function () {

  // summernote
  $('#summernote').summernote({
    height: 200
  });

  // bulk_options js code in view_all_posts page
  $('#selectAllBoxes').click(function (event) {
    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  });

});