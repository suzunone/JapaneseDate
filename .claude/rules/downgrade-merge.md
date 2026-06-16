# 上位Version取り込み手順

## git mergeでコンフリクトさせるまで
### v7.X系の場合
``` bash
git checkout v8.X
git pull origin refs/heads/v8.X
git checkout v7.X
git pull origin refs/heads/v7.X
git checkout -b feature/{feature-name}
composer update
git merge v8.X
```
### v6.X系の場合
``` bash
git checkout v7.X
git pull origin refs/heads/v7.X
git checkout v6.X
git pull origin refs/heads/v6.X
git checkout -b feature/{feature-name}
composer update
git merge v7.X
```

## コンフリクト解消方法
### srcとtestsとdocsは相手のコードをすべて取り込む
```bash
git restore --source MERGE_HEAD -- src
git restore --source MERGE_HEAD -- tests
git restore --source MERGE_HEAD -- docs
```

## 上記以外は一つずつコンフリクトを解消する
### 要注意ファイル
phpunit.coverage.xml
phpunit.xml
はphpunitのバージョン差異を考慮する。

## 一旦仮コミット
このままだと動作しない。
```bash
git commit -am "最新取り込みとコンフリクト解消"
```

## rector実行
```bash
composer rector
```

## 以下の手順による追加修正
### v7.X系
.claude/rules/carbon-downgrade.md

### v6.X系
.claude/rules/v7-to-v6-merge.md


## doc生成
```bash
composer doc
```