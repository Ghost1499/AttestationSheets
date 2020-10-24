<?php
    return array(
        new Route('/','authorization'),
        new Route('/login','authorization','login'),
        new Route('/signup','authorization','signup'),
        new Route('/logout','authorization','logout'),
        new Route('/sheets','sheets'),
        new Route('/sheets/sheet','sheets','sheet')
    );
