function addPasscode(key) {
  password += key;
}

function previewImage(elm) {
  var img = $('#uploadImg');
  if (elm.files[0]) {
    img.attr('src', URL.createObjectURL(elm.files[0]));
    img.show();
  }
  else {
    img.attr('src', null);
    img.hide();
  }
}

function setGrid() {
  var row = 7;
  var col = 5;
  var img = $('#uploadImg');
  var width = parseInt(img.outerWidth(true)/col);
  var height = parseInt(img.outerHeight(true)/row);
  // img.width(width*col).height(height*row);
  console.log('width: ' + width);
  console.log('height: ' + height);

  var content = '<table style="margin:auto;">';
  for(var i=0;i<row;i++) {
    content += '<tr>';
    for(var j=0;j<col;j++) {
      var key = (i+1) + String.fromCharCode(65 + j);
      content += `<td style="width:${width}px; height:${height}px" onclick="addPasscode('${key}')"></td>`;
    }
    content += '</tr>';
  }
  content += '</table>';
  $('#imageGrid').empty();
  $('#imageGrid').append(content);
  password = '';
}
