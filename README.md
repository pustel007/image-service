Image Service
=====

Small image service which can deliver images using a GET request and which are stored on the server.
It is possible to use different modifiers to change what will be returned.

Three modifiers are implemented:
1. crop-modifier (will cut the image and take height, width, x-offset and y-offset as parameters)
2. resize-modifier (resizes the images based on given height and width as parameters)
2. blur-modifier (blurs the images by intensity factor given as parameter)

Many modifiers can be combined in one request.

Further modifiers are be possible to integrate easily in code.
After you access an image you are redirected to a beautified image url.

The services outputs images in the same file format (e.g. jpg) as they have been read.

Simple HTML-page containing gallery of images is prepared and includes source and modified images.


# Installation

`docker compose up -d`
`docker compose exec php composer install`
`docker compose exec php chmod 777 public/images`


# Example usage

You want to retrieve image "one.jpg" in the size of 200px height and 200px width and blur it.
The original image on the server has the following dimensions: 600px height, 800px width

You trigger retrieving the image by using an url like: 
   http://localhost:8086/one.jpg/?mod=resize.200.200&mod=blur.3

You will get redirected to: 
   http://localhost:8086/images/one.resize.200.200.jpg

All the images are available in gallery:
   http://localhost:8086/gallery
