//Menampilkan semua Quotes + Berdasarkan Class, NIM
function getQuotes(url, title) {
    $.ajaxSetup({ cache: false });
    var item = $("#quote-item");
    $("#title-page").html(title);
    $(".quote-item").remove();
    item.appendTo("#quote-items");
    $.ajax({
       type: 'GET',
       url: url,
       beforeSend: function (xhr) {
          xhr.overrideMimeType("text/plain; charset=x-user-defined");
       },
       error: function (xhr, status, error) {
          console.log(xhr);
       }
    })

       // menampilkan data quotes
       .done(function (data) {
          myData = JSON.parse(data);
          for (i = 0; i < myData['quotes'].length; i++) {
             var item = $("#quote-item").clone();
             item.removeAttr("style");
             item.find('#card-description').html(myData['quotes'][i].description.replace('"', '\"').replace(/\n/g, '<br />'));
             item.find('#card-img').attr('src', myData['quotes'][i].images);
             item.find('#card-title').html(myData['quotes'][i].title);
             item.find('#card-name').html(myData['quotes'][i].name + " (" + myData['quotes'][i].class + ")");
             item.find('#card-date').html(myData['quotes'][i].updated);
             item.find('#view-detail').attr("onClick", "callModal(\"" + myData['quotes'][i].title + "\",\"" + myData['quotes'][i].name + " (" + myData['quotes'][i].class + ")\",\"" + myData['quotes'][i].images + "\",\"" + myData['quotes'][i].description.replace('"', '\\"').replace(/(\r\n|\n|\r)/gm, '<br>') + "\")");
             item.find('#edit-detail').attr("onClick", "callInputModal(\"Edit Quote\",\"" + myData['quotes'][i].title + "\",\"" + myData['quotes'][i].description.replace('"', '\\"').replace(/(\r\n|\n|\r)/gm, '<br>') + "\",\"" + myData['quotes'][i].images + "\",\"" + myData['quotes'][i].quote_id + "\")");
             item.find('#delete-quote').attr("onClick", "deleteQuote(" + myData['quotes'][i].quote_id + ",'" + myData['quotes'][i].title + "')");
             if (sessionStorage.getItem("student_id") != myData['quotes'][i].student_id) {
                item.find('#edit-detail').attr("style", "display: none;");
                item.find('#delete-quote').attr("style", "display: none;");
             }
             item.appendTo("#quote-items");
          }
       })
 }

 // inisialisasi sesi dengan student_id dan nim
 $(document).ready(function () {
    sessionStorage.setItem("student_id", "1197");
    sessionStorage.setItem("nim", "21102194");
    //getQuotes('https://quotesbeta.tugaskelas.my.id/index.php/quotes/q/my_quote/' + sessionStorage.getItem("nim"), 'My Quotes');

    $('#modal-input-form').submit(function (e) {
       e.preventDefault();
       var formData = $(this).serializeArray();
       if (formData[0].value == "") {
          insertQuote(this);
       }
       else {
          updateQuote(this);
       }
    });
 })

 // Memanggil class modal untuk menampilkan popup view details
 function callModal(title, name, image, description) {
    $('#quoteDetailModal').modal('show');
    $("#modal-title").html(title);
    $("#modal-name").html(name);
    $("#modal-description").html(description);
    $("#modal-img").attr('src', image);
 }

 // memanggil class modal untuk menambah quotes baru
 function callInputModal(title, name = "", description = "", image = "", quote_id = "") {
    $('#quoteInputModal').modal('show');
    $("#modal-input-title").html(title);
    $("#modal-input-form-quote-id").val(quote_id);
    $("#modal-input-form-student-id").val(sessionStorage.getItem("student_id"));
    $("#modal-input-form-title").val(name);
    $("#modal-input-form-image").val('');
    $("#modal-input-form-description").val(description);
    $("#modal-input-show-img").attr('src', image);
 }

 // membaca inputan file gambar dan melakukan show preview
 function readURL(input) {
    if (input.files && input.files[0]) {
       var reader = new FileReader();
       reader.onload = function (e) {
          $('#modal-input-show-img').attr('src', e.target.result);
       }
       reader.readAsDataURL(input.files[0]);
    }
 }
 $("#modal-input-form-image").change(function () {
    readURL(this);
 });

 //fungsi menambah quotes
 function insertQuote(data) {
    $.ajax({
       type: 'POST',
       url: "https://quotesbeta.tugaskelas.my.id/index.php/quotes",
       dataType: "JSON",
       data: new FormData(data),
       processData: false,
       contentType: false,
       beforeSend: function (xhr) {
          xhr.overrideMimeType("text/plain; charset=x-user-defined");
       },
       error: function (xhr, status, error) {
          console.log(xhr);
       }
    })
       .done(function (data) {
          console.log(data);
          getQuotes('https://quotesbeta.tugaskelas.my.id/index.php/quotes/q/my_quote/' + sessionStorage.getItem("nim"), 'My Quotes');
          $('#quoteInputModal').modal('toggle');
       });
 }

 // fungsi update quotes
 function updateQuote(data) {
    console.log(data);
    $.ajax({
       type: 'POST',
       url: "https://quotesbeta.tugaskelas.my.id/index.php/quotes/q/edit/1339",
       dataType: "JSON",
       data: new FormData(data),
       processData: false,
       contentType: false,
       beforeSend: function (xhr) {
          xhr.overrideMimeType("text/plain; charset=x-user-defined");
       },
       error: function (xhr, status, error) {
          console.log(xhr);
       }
    })
       .done(function (data) {
          console.log(data);
          getQuotes('https://quotesbeta.tugaskelas.my.id/index.php/quotes/q/my_quote/' + sessionStorage.getItem("nim"), 'My Quotes');
          $('#quoteInputModal').modal('toggle');
       });
 }

 // fungsi menghapus quotes
 function deleteQuote(quote_id, title) {
    var r = confirm("Delete " + title + "?");
    if (r == true) {
       $.ajax({
          type: 'DELETE',
          url: "https://quotesbeta.tugaskelas.my.id/index.php/quotes/q/quote_id/" + quote_id,
          beforeSend: function (xhr) {
             xhr.overrideMimeType("text/plain; charset=x-user-defined");
          },
          error: function (xhr, status, error) {
             console.log(xhr);
          }
       })
          .done(function (data) {
             console.log(data);
             getQuotes('https://quotesbeta.tugaskelas.my.id/index.php/quotes/q/my_quote/' + sessionStorage.getItem("nim"), 'My Quotes');
          });
    }
 }