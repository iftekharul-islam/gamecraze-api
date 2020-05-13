<template>
    <div>
        <nav class="navbar navbar-expand-xl navbar-light">
            <div class="container-fluid nav-width">
                <a class="navbar-brand mr-5" href="#"><img src="img/logo/logo.jpg" alt="Game-logo"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- menu-list -->
                    <div class="menu-list w-100">
                        <!-- menu-list-top -->
                        <ul class="navbar-nav menu-list-top">
                            <li class="nav-item mr-2">
                                <a class="nav-link" href="#">Platforms</a>
                            </li>
                            <li class="nav-item dropdown mr-3">
                                <a class="nav-link dropdown-toggle" href="#" id="serviceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Top Buyers/Sellers <i class="fas fa-chevron-down ml-1"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                                    <a class="dropdown-item" href="#">Game 1</a>
                                    <a class="dropdown-item" href="#">Game 2</a>
                                    <a class="dropdown-item" href="#">Game 3</a>
                                    <a class="dropdown-item" href="#">Game 4</a>
                                    <a class="dropdown-item" href="#">Game 5</a>
                                    <a class="dropdown-item" href="#">Game 6</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown mr-3">
                                <a class="nav-link dropdown-toggle" href="#" id="sitesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Trailer/Gameplay/Walkthrough <i class="fas fa-chevron-down ml-1"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="sitesDropdown">
                                    <a class="dropdown-item" href="#">Game 1</a>
                                    <a class="dropdown-item" href="#">Game 2</a>
                                    <a class="dropdown-item" href="#">Game 3</a>
                                    <a class="dropdown-item" href="#">Game 4</a>
                                    <a class="dropdown-item" href="#">Game 5</a>
                                    <a class="dropdown-item" href="#">Game 6</a>
                                </div>
                            </li>


                            <li class="nav-item mr-2">
                                <a class="nav-link" href="#">Latest News</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="nav-link" href="#">Fourm</a>
                            </li>
                            <li class="nav-item ml-auto search">
                                <form class="my-2 my-lg-0 menu-search">

                                    <div class="input-group">

                                        <div class="input-group-append">
                                            <input type="search" class="form-control menu-search-input" placeholder="Search...">
                                            <button class="btn btn-secondary menu-search-icon" type="button">
                                                <i class="fa fa-search "></i>
                                            </button>
                                        </div>
                                        <button class="btn btn-danger ml-4 sign-in-btn" type="submit">Sign in</button>
                                    </div>

                                </form>
                            </li>
                        </ul>

                        <!-- menu-list-bottom -->
                        <ul class="navbar-nav menu-list-bottom">

                            <li class="nav-item mr-3 for-active">
                                <a class="nav-link active" href="#">Home</a>
                            </li>

                            <li class="nav-item mr-3 for-active">
                                <a class="nav-link" href="#">Store</a>
                            </li>

                            <li class="nav-item mr-3 for-active">
                                <a class="nav-link" href="#">Categories</a>
                            </li>

                            <li class="nav-item dropdown for-active mr-4">
                                <a class="nav-link dropdown-toggle" href="#" id="serviceDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Lend/Borrow/Exchange <i class="fas fa-chevron-down ml-1"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                                    <a class="dropdown-item" href="#">Game 1</a>
                                    <a class="dropdown-item" href="#">Game 2</a>
                                    <a class="dropdown-item" href="#">Game 3</a>
                                    <a class="dropdown-item" href="#">Game 4</a>
                                    <a class="dropdown-item" href="#">Game 5</a>
                                    <a class="dropdown-item" href="#">Game 6</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown for-active mr-4">
                                <a class="nav-link dropdown-toggle" href="#" id="sitesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Game Shops <i class="fas fa-chevron-down ml-1"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="sitesDropdown">
                                    <a class="dropdown-item" href="#">Game 1</a>
                                    <a class="dropdown-item" href="#">Game 2</a>
                                    <a class="dropdown-item" href="#">Game 3</a>
                                    <a class="dropdown-item" href="#">Game 4</a>
                                    <a class="dropdown-item" href="#">Game 5</a>
                                    <a class="dropdown-item" href="#">Game 6</a>
                                </div>
                            </li>
                            <li class="nav-item mr-3 for-active">
                                <a class="nav-link" href="#">Support</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {

    }
</script>
