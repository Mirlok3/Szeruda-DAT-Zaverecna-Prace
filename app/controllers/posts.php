<?php

Class Posts extends Controller
{
    function index()
    {
        $data['page_title'] = "Posts";

        $data['posts'] = array(
            array(
                "title" => "Post 1 Title",
                "description" => "Eleifend assueverit dolor commune veniam. Cubilia atqui maiorum omnesque ipsum salutatus scelerisque lacus. Verear intellegat primis eleifend dignissim disputationi suscipit magna adipisci fames. Quaeque omittantur non accusata leo has. Quam fabulas expetenda graeco semper posse ex antiopam. A erroribus constituto malorum iusto dicant. Ridiculus no natoque doming sociosqu. Inimicus postea condimentum percipit quod graeci vis. Molestie phasellus lacinia fugit eum ad altera mutat. Agam ancillae movet patrioque euismod deserunt verterem nonumes suscipit noster. Aeque maluisset ac possim venenatis sonet ornare detraxit. Ad deseruisse nascetur viverra rutrum suas venenatis. Contentiones veri quo sadipscing eros pretium an. Maximus petentium definitionem mandamus affert mutat fuisset doming suas lacus. Natoque prodesset atqui persecuti suas amet cetero iisque aliquip. Elementum a sadipscing patrioque faucibus fastidii molestie leo recteque aliquip. Vivendo enim delenit luctus quas atqui partiendo integer esse nisi. Aptent graeco vulputate scripta aliquid semper accommodare. Congue rhoncus petentium expetendis faucibus tacimates gubergren fugit iriure curae. Semper melius lobortis evertitur arcu vim. Deterruisset nostra menandri errem ex duis laudem wisi noster fabellas."
            ),
            array(
                "title" => "Post 2 Title",
                "description" => "Post 2 Description"
            ),
            array(
                "title" => "Post 3 Title",
                "description" => "Post 3 Description"
            ),
            array(
                "title" => "Post 4 Title",
                "description" => "Post 4 Description"
            )
        );

        $this->view("posts", $data);
    }
}
