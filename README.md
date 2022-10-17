# ST Assetment

> Additional information or tagline

Voucher API Generator

## Installing / Getting started

```shell
docker-compose up -d
```

After that go ahead and visit or curl `http://localhost:8000`

## API Features

1. Generate Vouchers - [POST]`localhost:8000/api/voucher/generate` -
NOTE: please wait a few seconds, you will get an `id` for you to track its progress

2. Return total processing time of batch based on `id` - [GET]`localhost:8000/voucher/batch?id=97869778-54ad-4061-82c5-ea8fcc913081`. You can get `id` for return on API 1.

3. Get voucher - [GET]`localhost:8000/voucher/get`

4. Claim voucher - [GET]`localhost:8000/voucher/claim?code=5502b9`

5. View voucher stats - [GET]`localhost:8000/voucher/stats`

## Contributing

## Links

## Licensing

None
