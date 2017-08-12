require('./bootstrap');

var uploadErrors = false;

new Dropzone("#dropzone", {
    params: {
      _token: window.Laravel.csrfToken,
    },
    url: '/admin/photos',
    autoProcessQueue: true,
    maxFilesize: 100,
    parallelUploads: 10,
    uploadMultiple: true,
    error: function() {
      uploadErrors = true;
  	},
    queuecomplete: function(){
    	if(!uploadErrors) location.reload();
    }
});

var el = document.getElementById('photos');
var sortable = Sortable.create(el, {
  dataIdAttr: 'data-model-id',
  handle: '.drag-handle',
  sort: true,
  animation: 150,
  scrollSensitivity: 150, // px, how near the mouse must be to an edge to start scrolling.
  scrollSpeed: 100, // px
  onEnd: function (evt) {
    // var photoId = evt.item.getAttribute('data-model-id');
    // var orderValue = evt.newIndex;
    // console.log(sortable.toArray());
	  axios.post('/admin/photos/reorder', {sort_order: sortable.toArray()})
	  .then(function (response) {
	    console.log(response);
	  })
	  .catch(function (error) {
	    console.log(error);
	  });
	},
});