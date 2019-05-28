<?php

namespace spec\Dao\Entity;

use Dao\Entity\CupPlayerEntity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CupPlayerEntity::class);
    }

    function it_converts_text_to_pascal_case() {
        $this->toPascalCase('showByCategory')->shouldReturn('showByCategory');
        // $this->toPascalCase('show-by-category')->shouldReturn('showByCategory');
        // $this->toPascalCase('ShowByCategory')->shouldReturn('showByCategory');
    }
}
