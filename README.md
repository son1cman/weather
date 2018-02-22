# Weather Cities Gallery

Testing Skills

## Getting Started

A RESTful server implementation with CodeIgniter.

### Prerequisites

PHP 5.4 or greater
CodeIgniter 3.0+



### Handling Requests

Front Html

```
<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile" id="userfile">
    <input type="submit" value="Upload Image" name="submit">
</form>
```

Front JS

```
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
  
  var form_data = new FormData($('#uploadimage')[0]);
  $.ajax({
      type:'POST',
      url:'http://localhost/ww/v1/uploads',
      processData: false,
      contentType: false,
      async: false,
      cache: false,
      data : form_data  });
}));
```

This will do the trick

## Running the tests

Go to http://localhost/cliente/ for full example

### Api Conventions

Front must use prefix 'http://localhost/ww/public/' in order to load images.

```
function getcitiesfromapi(){
                $.get('http://localhost/ww/v1/', function(data){
			
            var $myDiv = $('#Gall');
            $myDiv.empty()
            //console.log(data.response); // Debug
           
                $(data.response).each(function(j, k){
                    var $img = $('<img></img>');
                    $img.attr('src', 'http://localhost/ww/public/' + k.name).height(365).width(365).addClass("gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6");

                    $myDiv.append($img);
                });
                
         //   });
        });
```

### HTTP Verbs

HTTP verbs, or methods, should be used in compliance with their definitions under the [HTTP/1.1](http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html) standard.
The action taken on the representation will be contextual to the media type being worked on and its current state:

| HTTP METHOD | POST            | GET       | PUT         | DELETE |
| ----------- | --------------- | --------- | ----------- | ------ |
| CRUD OP     | CREATE          | READ      | UPDATE      | DELETE |
| /uploads    | Create new image| erro      | error       | error  |
| /searches/1234  | Error           | Show Bo   | If exists, update Bo; If not, error | Delete Bo |

```
Api ww/v1
```

## Error Handling

200 - OK
400 - Bad Request
404 - Not Found
500 - Internal Server Error

## Versioning

V1.0

## Authors

* **Kevin Martinez** - *Initial work* - [PurpleBooth](https://github.com/son1cman)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Google
* Wikipedia
* StackOverFlow
