terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
    }
  }
}

provider "aws" {
  region = "us-east-1"
}

resource "aws_dynamodb_table" "GuestBook" {
  name        = "GuestBook"
  read_capacity  = 10
  write_capacity = 10
  hash_key       = "Email"
  attribute {
    name = "Email"
    type = "S"
  }
   tags = {
    environment       = "dev"
  }
}

resource "aws_dynamodb_table_item" "dynamodb_schema_table_item" {
  for_each = local.tf_data
  table_name = aws_dynamodb_table.GuestBook.name
  hash_key   = "Email"
  item = jsonencode(each.value)
} 