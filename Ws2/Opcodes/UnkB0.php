<?php
namespace Ws2\Opcodes;

/**
 * B0 [name=string][NULL]
 * [byte * 4 or dword][float * 4]
 */
class UnkB0 extends AbstractOpcode
{
    public const OPCODE = 'B0';
    public const FUNC = 'UnkB0';

    public function decompile(\Helper\FastBuffer &$dataSource): self
    {
        [$channel, $channelLen] = $this->reader->readString($dataSource);
        $config = $this->reader->readData($dataSource, 4);
        $floats = $this->reader->readFloats($dataSource, 4);
        $this->compiledSize = 1 + $channelLen + 4 + 4*4;

        $this->content = static::FUNC . " ({$channel}, {$config[0]}, {$config[1]}, {$config[2]}, {$config[3]}, ".implode(', ', $floats).")";
        return $this;
    }

    public function preCompile(?string $params = null): self
    {
        $params = $this->reader->unpackParams($params);

        $this->content = $this->reader->convertHexToChar(static::OPCODE) .
            $this->reader->packString($params[0]) .
            pack('c4', (int)$params[1], (int)$params[2], (int)$params[3], (int)$params[4]).
            pack('f4', (float)$params[5], (float)$params[6], (float)$params[7], (float)$params[8]);
        return $this;
    }
}
