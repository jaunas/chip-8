<?php

namespace Jaunas\Chip8\DataType;

class Memory extends GenericMemory
{
    const SIZE = 4096;

    private const FONT_OFFSET   = 0x0000;
    public const PROGRAM_OFFSET = 0x0200;

    private const FONT_SET =
        "\xF0\x90\x90\x90\xF0" . // 0
        "\x20\x60\x20\x20\x70" . // 1
        "\xF0\x10\xF0\x80\xF0" . // 2
        "\xF0\x10\xF0\x10\xF0" . // 3
        "\x90\x90\xF0\x10\x10" . // 4
        "\xF0\x80\xF0\x10\xF0" . // 5
        "\xF0\x80\xF0\x90\xF0" . // 6
        "\xF0\x10\x20\x40\x40" . // 7
        "\xF0\x90\xF0\x90\xF0" . // 8
        "\xF0\x90\xF0\x10\xF0" . // 9
        "\xF0\x90\xF0\x90\x90" . // A
        "\xE0\x90\xE0\x90\xE0" . // B
        "\xF0\x80\x80\x80\xF0" . // C
        "\xE0\x90\x90\x90\xE0" . // D
        "\xF0\x80\xF0\x80\xF0" . // E
        "\xF0\x80\xF0\x80\x80";  // F

    public function __construct()
    {
        parent::__construct(self::SIZE);

        $this->loadFontSet();
    }

    private function loadFontSet()
    {
        $this->insertBlock(GenericMemory::fromString(self::FONT_SET), self::FONT_OFFSET);
    }

    public function loadProgram(GenericMemory $programCode)
    {
        $this->insertBlock($programCode, self::PROGRAM_OFFSET);
    }

    public function fetchOpcode(int $programCounter): Opcode
    {
        return new Opcode($this[$programCounter] << 8 | $this[$programCounter + 1]);
    }
}