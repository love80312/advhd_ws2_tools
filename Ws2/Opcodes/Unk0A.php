<?php
namespace Ws2\Opcodes;

/**
 * Not sure if it was correctly used, don't see it. Check on tests
 */
class Unk0A extends AbstractUndefined
{
    public const OPCODE = '0A';
    public const FUNC = 'Unk0A';
    
    public function getSize(): int
    {
        return 22;
    }
}