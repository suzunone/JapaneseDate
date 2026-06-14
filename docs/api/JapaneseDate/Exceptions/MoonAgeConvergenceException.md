# MoonAgeConvergenceException

**Namespace:** `JapaneseDate\Exceptions`

class **MoonAgeConvergenceException** extends [Exception](../../JapaneseDate/Exceptions/Exception.md)

月齢収束失敗例外。

{\JapaneseDate\Components\MeeusMoonAge::moonAge()} で朔の時刻が
最大反復回数（30回）以内に収束しなかった場合にスローされます。

Elp2000MoonAge の「入力時刻を朔として返す」静かなフォールバックとは異なり、
収束失敗を明示的に例外として通知します。

