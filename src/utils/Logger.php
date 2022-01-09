<?php

namespace Lishenna\utils;

class Logger
{

    public const FORMAT_BOLD = "\x1b[1m";
    public const FORMAT_OBFUSCATED = "";
    public const FORMAT_ITALIC = "\x1b[3m";
    public const FORMAT_UNDERLINE = "\x1b[4m";
    public const FORMAT_STRIKETHROUGH = "\x1b[9m";

    public const FORMAT_RESET = "\x1b[m";

    public const COLOR_BLACK = "\x1b[38;5;16m";
    public const COLOR_DARK_BLUE = "\x1b[38;5;19m";
    public const COLOR_DARK_GREEN = "\x1b[38;5;34m";
    public const COLOR_DARK_AQUA = "\x1b[38;5;37m";
    public const COLOR_DARK_RED = "\x1b[38;5;124m";
    public const COLOR_PURPLE = "\x1b[38;5;127m";
    public const COLOR_GOLD = "\x1b[38;5;214m";
    public const COLOR_GRAY = "\x1b[38;5;145m";
    public const COLOR_DARK_GRAY = "\x1b[38;5;59m";
    public const COLOR_BLUE = "\x1b[38;5;63m";
    public const COLOR_GREEN = "\x1b[38;5;83m";
    public const COLOR_AQUA = "\x1b[38;5;87m";
    public const COLOR_RED = "\x1b[38;5;203m";
    public const COLOR_LIGHT_PURPLE = "\x1b[38;5;207m";
    public const COLOR_YELLOW = "\x1b[38;5;227m";
    public const COLOR_WHITE = "\x1b[38;5;231m";

    public static function info(string $msg): void
    {
        echo self::COLOR_WHITE . "[I] " . $msg . self::FORMAT_RESET . PHP_EOL;
    }

    public static function success(string $msg): void
    {
        echo self::COLOR_GREEN . "[S] " . $msg . self::FORMAT_RESET . PHP_EOL;
    }

    public static function error(string $msg): void
    {
        echo self::COLOR_RED . "[E] " . $msg . self::FORMAT_RESET . PHP_EOL;
    }

    public static function warning(string $msg): void
    {
        echo self::COLOR_YELLOW . "[W] " . $msg . self::FORMAT_RESET . PHP_EOL;
    }

    public static function debug(string $msg): void
    {
        if (DEBUG) {
            echo self::COLOR_GRAY . "[D] " . $msg . self::FORMAT_RESET . PHP_EOL;
        }
    }
}