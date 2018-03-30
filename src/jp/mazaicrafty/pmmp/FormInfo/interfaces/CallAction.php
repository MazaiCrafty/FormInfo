<?php

namespace jp\mazaicrafty\pmmp\FormInfo\interfaces;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\Main;

interface CallAction{
    public function getMain(): Main;
}
