<?php

namespace Jaunas\Chip8\DataType;

class Screen extends GenericMemory
{
    const WIDTH = 64;
    const HEIGHT = 32;

    public function __construct()
    {
        parent::__construct(self::WIDTH * self::HEIGHT);
    }

    public function setPixel(int $x, int $y, int $pixel)
    {
        if ($x >= self::WIDTH || $y >= self::HEIGHT) {
            return;
        }

        $this[$x + $y * self::WIDTH] = $pixel;
    }

    public function getPixel(int $x, int $y): int
    {
        if ($x >= self::WIDTH || $y >= self::HEIGHT) {
            return 0;
        }

        return $this[$x + $y * self::WIDTH];
    }

    public function drawSprite(GenericMemory $spriteData, int $x, int $y): bool
    {
        $flipped = false;

        for ($i=0; $i < $spriteData->getSize(); $i++) {
            if ($this->drawLine($spriteData[$i], $x, $y+$i)) {
                $flipped = true;
            }
        }

        return $flipped;
    }

    private function drawLine(int $line, int $x, int $y): bool
    {
        $flipped = false;

        for ($i=0; $i<8; $i++) {
            $change = (bool) ($line & (0x80 >> $i));
            $oldPixel = $this->getPixel($x+$i, $y);

            if ($change == 1) {
                if ($oldPixel == 1) {
                    $flipped = true;
                }

                $newPixel = $oldPixel^1;
                $this->setPixel($x+$i, $y, $newPixel);
            }
        }

        return $flipped;
    }

    /**
     * @return string[]
     */
    public function getLines(): array
    {
        return str_split($this->memory, self::WIDTH);
    }
}
