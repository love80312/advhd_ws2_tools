<?php
namespace Ws2\Opcodes;

/**
 * 30 [name=string][NULL]
 * [float]
 */
class SoundEffectUnk30 extends AbstractOpcode
{
    public const OPCODE = '30';
    public const FUNC = 'SoundEffectUnk30';

    public function decompile(\Helper\FastBuffer &$dataSource): self
    {
        [$channel, $channelLen] = $this->reader->readString($dataSource);
        $float = $this->reader->readFloat($dataSource);
        $this->compiledSize = 1 + $channelLen + 4;

        $this->content = static::FUNC . " ({$channel}, {$float})";
        return $this;
    }

    public function preCompile(?string $params = null): self
    {
        $params = $this->reader->unpackParams($params);

        $this->content = $this->reader->convertHexToChar(static::OPCODE) .
            $this->reader->packString($params[0]) .
            pack('f', (float)$params[1]);
        return $this;
    }
}
