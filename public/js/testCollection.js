var $collectionHolder;

var $addImageButton = $('<button type="button" class="add_image_link">Ajout d\'une image</button>');
var $newLink = $('<p></p>').append($addImageButton);


$(document).ready(function() {
    $collectionHolder = $(".images");

    // add a delete link to all of the existing image form li elements
    $collectionHolder.find('p').each(function() {
        addImageFormDeleteLink($(this));
    });

    $collectionHolder.append($newLink);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addImageButton.on('click', function(e) {
        addImageForm($collectionHolder, $newLink);
    });
});

function addImageFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button">enlever cette image</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

function addImageForm($collectionHolder, $newLink) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have

    newForm = newForm.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<p></p>').append(newForm);
    $newLink.after($newFormLi);

    // add a delete link to the new form
    addImageFormDeleteLink($newFormLi);
}
