# WARP.md - Working AI Reference for ipex-b2b

## Project Overview
**Type**: PHP Project/Debian Package
**Purpose**: ![Ipex-b2b Logo](https://github.com/Spoje-NET/Ipex-b2b/raw/master/ipex-b2b-logo.png "Project Logo")
**Status**: Active
**Repository**: git@github.com:Spoje-NET/ipex-b2b.git

## Key Technologies
- PHP
- Composer
- Debian Packaging

## Architecture & Structure
```
ipex-b2b/
├── src/           # Source code
├── tests/         # Test files
├── docs/          # Documentation
└── ...
```

## Development Workflow

### Prerequisites
- Development environment setup
- Required dependencies

### Setup Instructions
```bash
# Clone the repository
git clone git@github.com:Spoje-NET/ipex-b2b.git
cd ipex-b2b

# Install dependencies
composer install
```

### Build & Run
```bash
dpkg-buildpackage -b -uc
```

### Testing
```bash
composer test
```

## Key Concepts
- **Main Components**: Core functionality and modules
- **Configuration**: Configuration files and environment variables
- **Integration Points**: External services and dependencies

## Common Tasks

### Development
- Review code structure
- Implement new features
- Fix bugs and issues

### Deployment
- Build and package
- Deploy to target environment
- Monitor and maintain

## Troubleshooting
- **Common Issues**: Check logs and error messages
- **Debug Commands**: Use appropriate debugging tools
- **Support**: Check documentation and issue tracker

## Additional Notes
- Project-specific conventions
- Development guidelines
- Related documentation
