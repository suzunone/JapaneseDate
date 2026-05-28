php vendor/rector/rector/bin/rector.php
perl -0i -pe 's/(protected function get[A-Z]\w+Holiday\([^)]*\): array\n    \{)/$1\n        \$year = (int) \$year;/g' src/Components/JapaneseDate.php
