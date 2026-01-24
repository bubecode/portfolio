#!/bin/bash

# Check if both arguments are provided
if [ -z "$1" ] || [ -z "$2" ]; then
  echo "Usage: ./archive-changes.sh <latest_commit> <base_commit>"
  echo "Please provide both the latest commit hash and the base commit hash."
  exit 1
fi

latest_commit=$1
base_commit=$2
output="package.zip"

# Verify that the commits exist in the repository
if ! git cat-file -e "$latest_commit" 2>/dev/null; then
  echo "Error: Commit $latest_commit does not exist."
  exit 1
fi

if ! git cat-file -e "$base_commit" 2>/dev/null; then
  echo "Error: Commit $base_commit does not exist."
  exit 1
fi

# Archive the changes
git archive --output=$output $latest_commit $(git diff --name-only $base_commit..$latest_commit --diff-filter=d)

echo "Archived changes to $output"

: '
    Steps to Use:
    1. Make sure the script is executable. If not, use:
       chmod +x archive-changes.sh

    2. Run the script by passing two commit hashes:
       ./archive-changes.sh <latest_commit> <base_commit>

       - <latest_commit>: The commit hash representing the latest changes.
       - <base_commit>: The commit hash representing the starting point to check for changes.

    Example:
       ./archive-changes.sh 1a64b9e5 b5cb910e

    This will create a file named "package.zip" containing all files changed 
    between the specified commits.
'